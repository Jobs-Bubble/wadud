<template>

    <app-pre-loader v-if="preloader"/>
    <div v-else>
        <app-note
            class="mb-primary"
            :title="$t('note')"
            :notes="$t('cron_job_setting_warning')"
        />
        <p>{{ this.$t('cron_job_setting_suggestion') }}</p>
        <p>{{ this.$t('cron_job_setting_suggestion_1') }}</p>

        <div class="mb-primary">
            <h4>Enable Symlink by Cronjob:</h4>
            <p class="pb-2 border-bottom">Please copy the command below and insert into your hosted server’s crontab.</p>
            <div class="row">
                <div class="col-lg-3 col-xl-3 col-md-12">
                    {{ $t('command') }}
                </div>
                <div class="col-lg-9 col-xl-9 col-md-12 d-inline-flex justify-content-between flex-wrap">
                    <p ref="cmd" id="with_php_cmd" v-on:focus="$event.target.select()" readonly>
                        <code>{{ settings.cpanel_command }}</code>
                    </p>
                    <button type="button"
                            class="btn btn-sm d-inline-flex width-100 height-30 align-items-center justify-content-center"
                            :class="isCopied ? 'btn-success' : 'btn-warning'"
                            @mouseleave="afterCopied('with_php_cmd')"
                            @click="copy('with_php_cmd')">
                        <span v-if="isCopied" :key="'check1'">
                            <app-icon name="check" class="size-18 mr-2"/> {{ $t('copied') }}
                        </span>
                        <span v-else :key="'copy1'">
                            <app-icon name="copy" class="size-18 mr-2"/> {{ $t('copy') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {axiosGet} from "../../../../Helpers/AxiosHelper";
import {CRON_JOB_SETTING} from "../../../../Config/ApiUrl";

export default {
    name: "CronJobSetting",
    data() {
        return {
            settings: [],
            preloader: false,
            isCopied: false,
            isCmdCopied: false,
        }
    },
    methods: {
        getCronJobSettings() {
            this.preloader = true;
            axiosGet(CRON_JOB_SETTING).then(({data}) => {
                this.settings = data;
            }).finally(() => {
                this.preloader = false;
            })
        },
        copy(id) {
            let copyText = document.getElementById(id);
            let input = document.createElement("textarea");
            input.value = copyText.textContent;
            document.body.appendChild(input);
            input.select();
            document.execCommand("Copy");
            input.remove();
            id === 'with_php_cmd' ?  this.isCopied = true : this.isCmdCopied = true;
        },
        afterCopied(id) {
            setTimeout(() => {
                id === 'with_php_cmd' ?  this.isCopied = false : this.isCmdCopied = false;
            }, 1000)
        }
    },
    created() {
        this.getCronJobSettings();
    }
}
</script>
