<template>
    <div class="content-wrapper">
        <app-breadcrumb :page-title="pageTitle" :icon="pageIcon"/>
        <app-tab :tabs="tabs" :icon="pageIcon"/>
    </div>
</template>

<script>
    export default {
        name: 'SettingsLayout',
        props: {
            permissions: {}
        },
        data() {
            return {
                pageTitle: this.$t('app_settings'),
                pageIcon: 'settings',
                tabs: [
                    {
                        "name": this.$t('general'),
                        "title": this.$t('general'),
                        "component": "general-setting",
                        "permission": this.permissions.general,
                    },
                    {
                        name: this.$t('cron_job'),
                        title: this.$t('cron_job'),
                        component: "app-cron-job-settings",
                        props: {},
                    },
                    {
                        "name": this.$t('email_setup'),
                        "title": this.$t('email_setup'),
                        "component": "email-setting",
                        "permission": this.permissions.email_settings,
                    },
                   /* {
                        "name": this.$t('sms_setup'),
                        "title": this.$t('sms_setup'),
                        "component": "sms-setting",
                        "permission": this.permissions.sms_settings,
                    },*/
                  /*{
                        "name": this.$t('google_re_captcha'),
                        "title": this.$t('google_re_captcha'),
                        "component": "google-re-captcha-setting",
                        "permission": this.permissions.recaptcha_settings,
                    },*/
                    {
                        "name": this.$t('notification'),
                        "title": this.$t('notification'),
                        "component": "notification-settings",
                        "permission": this.permissions.notification,
                    },
                    {
                        'name': this.$t('update'),
                        'title': this.$t('update'),
                        'component': 'app-update',
                        'permission': '',
                        'props': "",
                    },
                ]
            }
        },
    }
</script>
