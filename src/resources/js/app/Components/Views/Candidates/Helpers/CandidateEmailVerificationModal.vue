<template>
    <modal
        :modal-id="modalId"
        :title="$t('verify_email')"
        :preloader="preloader"
        :modal-backdrop="false"
        modal-size="default"
        :submit-button-text="$t('next')"
        :hide-cancel-button="true"
        @submit="submit"
        @closeModal="closeModal">
        <template slot="body">
            <app-overlay-loader v-if="preloader"/>
            <form class="mb-0"
                  :class="{'loading-opacity': preloader}"
                  ref="form"
                  :data-url="PUBLIC_VERIFY_EMAIL">
                <div class="form-group row align-items-center">
                    <label for="verify-email" class="mb-sm-0 col-sm-3">
                        {{ $t('email') }}
                    </label>
                    <div class="col-sm-9">
                        <app-input
                            type="email"
                            :placeholder="$placeholder('email')"
                            id="verify-email"
                            :required="true"
                            v-model="formData.email_address"
                        />
                    </div>
                </div>
            </form>
        </template>
    </modal>
</template>

<script>

import {PUBLIC_VERIFY_EMAIL} from "../../../../Config/ApiUrl";
import {FormMixin} from "../../../../../core/mixins/form/FormMixin";

export default {
    name: 'CandidateEmailVerificationModal',
    mixins: [FormMixin],
    props: {
        jobPostId: {}
    },
    data() {
        return {
            modalId: 'candidate-email-verification-modal',
            PUBLIC_VERIFY_EMAIL,
            preloader: false,
            formData: {
                email_address: '',
                job_post_id: this.jobPostId
            }
        }
    },
    methods: {
        beforeSubmit() {
            this.preloader = true;
        },
        submit() {
            this.save(this.formData);
        },
        afterSuccess(response) {
            if(response.data.status == false)
                this.$toastr.w(response.data.message);
            else {
                this.$emit('verifiedData', this.formData.email_address, response.data);
                $(`#${this.modalId}`).modal('hide');
            }
            this.preloader = false;
        },
        afterError(res) {
            this.$toastr.e(res.data.message);
        },
        closeModal() {
            this.$toastr.w(this.$t('you_have_to_verify_your_email_first'));
            this.$emit('dontVerified');
        },
    }
}
</script>
