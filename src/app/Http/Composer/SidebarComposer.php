<?php

namespace App\Http\Composer;

use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $view->with(['data' => [
            [
                'icon' => 'pie-chart',
                'name' => trans('default.dashboard', [], app_get_locale()),
                'url' => request()->root() . '/admin/dashboard',
                'permission' => true,
            ],
            [
                'icon' => 'users',
                'name' => trans('default.candidates', [], app_get_locale()),
                'url' => request()->root() . '/candidates',
                'permission' => auth()->user()->can('can_view_applicant'),
            ],
            [
                'icon' => 'layout',
                'name' => trans('default.career_page', [], app_get_locale()),
                'url' => request()->root() . '/career-page',
                'permission' => auth()->user()->can('can_view_career_page'),
            ],
            [
                'icon' => 'user-check',
                'name' => trans('default.user_and_roles', [], app_get_locale()),
                'url' => request()->root() . '/users-and-roles',
                'permission' => authorize_any(['view_users', 'view_roles', 'invite_user', 'create_roles']),
            ],
            [
                'name' => trans('default.settings', [], app_get_locale()),
                'id' => 'settings',
                'permission' => authorize_any(
                    [
                        'view_settings',
                        'can_view_job_setting'
                    ]
                ),
                'icon' => 'settings',
                'subMenu' => [
                    [
                        'name' => trans('default.app_settings', [], app_get_locale()),
                        'url' => request()->root() . '/app-setting',
                        'permission' => authorize_any([
                            'view_settings',
                            'update_settings',
                            'view_delivery_settings',
                            'update_delivery_settings',
                            'view_sms_settings',
                            'update_sms_settings',
                            'view_notification_settings',
                            'update_notification_settings',
                            'update_notification_templates',
                            'view_notification_templates',
                        ]),
                    ],
                    [
                        'name' => trans('default.job_settings_menu', [], app_get_locale()),
                        'url' => request()->root() . '/job-setting',
                        'permission' => auth()->user()->can('can_view_job_setting'),
                    ],
                    [
                        'name' => trans('default.integrations', [], app_get_locale()),
                        'url' => request()->root() . '/integrations',
                        //'permission' => auth()->user()->can('can_view_job_setting'),
                        'permission' => true,
                    ]
                ],
            ],
        ]]);
    }
}
