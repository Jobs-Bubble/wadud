<template>
    <li class="nav-item dropdown">
        <a href="#"
           id="languageDropdown"
           class="d-flex align-items-center nav-link dropdown-toggle"
           data-toggle="dropdown"
           aria-expanded="false">
            {{ selectedLanguage }}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown language-dropdown"
             aria-labelledby="languageDropdown">
            <a
                class="dropdown-item"
                v-for="(item, index) in data"
                :href="item.url"
                :key="index"
                @click.prevent="setLocale(item.key)"
            >
                <div class="d-flex align-items-center justify-content-center">
                    <h6 class="mb-0 font-weight-normal">{{ item.title }}</h6>
                </div>
            </a>
        </div>
    </li>
</template>

<script>
import {FormMixin} from "../../../mixins/form/FormMixin";
import {LANG} from "../../../../app/Config/ApiUrl";

export default {
    name: "LanguageDropdown",
    mixins: [FormMixin],
    props: {
        selectedLanguage: {
            type: String,
            required: true
        },
        data: {
            type: Array,
            required: true
        }
    },
    methods: {
        setLocale(lang) {
            this.axiosPost({
                url: LANG,
                data: {
                    lang: lang,
                },
            }).then(() => {
                window.location.reload();
            });
        },
    },
}
</script>
