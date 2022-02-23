<template>
    <Guest>
        <v-container fill-height>
            <v-row justify="center">
                <v-card class="col-10 col-md-3"
                        color="secondary"
                        dark>
                    <v-card-title class="text-h4 justify-center"
                                  secondary-title>Register
                    </v-card-title>
                    <v-card-text class="my-4">
                        <v-form @submit.prevent="submit">
                            <v-text-field v-model="form.name"
                                          :error-messages="form.errors.name"
                                          label="Name"
                                          prepend-inner-icon="mdi-account"
                                          solo-inverted>
                            </v-text-field>
                            <v-text-field v-model="form.phone"
                                          :error-messages="form.errors.phone"
                                          label="Phone"
                                          prepend-inner-icon="mdi-phone"
                                          solo-inverted>
                            </v-text-field>
                            <v-text-field v-model="form.email"
                                          :error-messages="form.errors.email"
                                          label="Email"
                                          prepend-inner-icon="mdi-email"
                                          solo-inverted>
                            </v-text-field>
                            <v-text-field v-model="form.password"
                                          :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                          :error-messages="form.errors.password"
                                          :type="show ? 'text' : 'password'"
                                          label="Password"
                                          prepend-inner-icon="mdi-lock"
                                          solo-inverted
                                          @click:append="show = !show">
                            </v-text-field>
                            <v-text-field v-model="form.password_confirmation"
                                          :append-icon="confirmShow ? 'mdi-eye' : 'mdi-eye-off'"
                                          :error-messages="form.errors.password_confirmation"
                                          :type="confirmShow ? 'text' : 'password'"
                                          label="Confirm Password"
                                          prepend-inner-icon="mdi-lock"
                                          solo-inverted
                                          @click:append="confirmShow = !confirmShow">
                            </v-text-field>
                            <v-textarea v-model="form.address"
                                        :error-messages="form.errors.address"
                                        label="Address"
                                        prepend-inner-icon="mdi-map-marker"
                                        rows="2"
                                        solo-inverted>
                            </v-textarea>
                            <v-btn :disabled="form.processing"
                                   block
                                   color="primary"
                                   large
                                   type="submit">
                                SUBMIT
                            </v-btn>
                        </v-form>
                    </v-card-text>
                    <v-divider class="mx-4"
                               width="full"></v-divider>
                    <v-card-actions class="mt-4 mx-2">
                        <Link :href="route('login')"
                              as="v-btn"
                              block
                              color="red"
                              method="post"
                              outlined
                              rounded>
                            <v-icon left>mdi-google</v-icon>
                            Sign Up with Google
                        </Link>
                    </v-card-actions>
                    <v-card-actions class="mx-2 mb-4">
                        <Link :href="route('login')"
                              as="v-btn"
                              block
                              class="text-normal"
                              color="blue"
                              method="post"
                              outlined
                              rounded>
                            <v-icon left>mdi-facebook</v-icon>
                            Sign Up with Facebook
                        </Link>
                    </v-card-actions>
                </v-card>
            </v-row>
        </v-container>
    </Guest>
</template>

<script>
import Guest from "@/Layouts/Guest";
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        Guest,
        Link
    },
    data() {
        return {
            show: false,
            confirmShow: false,
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                phone: '',
                address: '',
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    }
}
</script>

<style scoped>
.v-btn {
    text-transform: none !important;
}
</style>