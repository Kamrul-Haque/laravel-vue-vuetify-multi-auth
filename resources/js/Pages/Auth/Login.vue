<template>
    <Guest>
        <Head title="Login"/>
        <v-container fill-height>
            <v-row justify="center">
                <v-card class="col-10 col-sm-8 col-md-4 col-lg-3"
                        color="secondary"
                        dark>
                    <v-card-title class="text-h5 justify-center">Login</v-card-title>
                    <v-card-text class="my-4">
                        <v-form @submit.prevent="submit">
                            <v-text-field v-model="form.email"
                                          :error-messages="form.errors.email"
                                          dense
                                          label="Email"
                                          prepend-inner-icon="mdi-email"
                                          solo-inverted>
                            </v-text-field>
                            <v-text-field v-model="form.password"
                                          :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                          :error-messages="form.errors.password"
                                          :type="show ? 'text' : 'password'"
                                          class="mt-4"
                                          dense
                                          label="Password"
                                          prepend-inner-icon="mdi-lock"
                                          solo-inverted
                                          @click:append="show = !show">
                            </v-text-field>
                            <v-checkbox v-model:checked="form.remember"
                                        color="primary"
                                        label="Remember Me">
                            </v-checkbox>
                            <v-btn :disabled="form.processing"
                                   block
                                   color="primary"
                                   type="submit">
                                SUBMIT
                            </v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
    </Guest>
</template>

<script>
import Guest from "@/Layouts/Guest";
import {Head, Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        Guest,
        Link,
        Head
    },
    data() {
        return {
            show: false,
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            });
        }
    }
}
</script>