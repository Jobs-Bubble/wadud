<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use RecursiveDirectoryIterator;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{

    public function index()
    {
        return cache()->remember('languages-'.count( glob(resource_path('lang/*'), GLOB_ONLYDIR)), 604800, function () {
            $data = [];
            $directories = new RecursiveDirectoryIterator(resource_path('lang'));
            while ($directories->valid()) {
                if (! $directories->isDot() && $directories->getBasename() !== '.DS_Store'){
                    array_push($data, [
                        'title' => $this->findLanguage($directories->getBasename())['name'],
                        'url' => route('language.change', ['lang' => $directories->getBasename()]),
                        'key' => $directories->getBasename()
                    ]);
                }
                $directories->next();
            }
            return $data;
        });
    }

    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($locale)
    {
        session()->put('locale', $locale);

        return redirect()->back();
    }

    public function findLanguage($code)
    {
        return collect(config('language.languages'))
            ->firstWhere('code', $code);
    }


    public function show($lang)
    {
        return [
            'cache' => app()->environment() == 'production',
            'languages' => include resource_path().DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'default.php',
            'key' => $lang
        ];
    }

    public function userLevelLanguageSwap()
    {
        //user level preference
        \Cookie::queue(\Cookie::forget('user_lang'));
        \Cookie::queue(\Cookie::forever('user_lang', request()->get('lang')));
      //  return redirect()->back();

    }


}
