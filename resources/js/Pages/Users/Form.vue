<template>
    <Admin>
        <Head title="Users"/>
        <v-card class="col-12 col-md-3 mx-auto">
            <v-card-title class="text-h5 justify-center secondary--text"
                          v-text="user?'Edit User':'Create User'"></v-card-title>
            <v-card-text>
                <v-form @submit.prevent="submit">
                    <v-text-field v-model="form.name"
                                  :error-messages="form.errors.name"
                                  autofocus
                                  label="Name"
                                  prepend-inner-icon="mdi-account">
                    </v-text-field>
                    <v-text-field v-model="form.email"
                                  :error-messages="form.errors.email"
                                  label="Email"
                                  prepend-inner-icon="mdi-email">
                    </v-text-field>
                    <v-text-field v-model="form.phone"
                                  :error-messages="form.errors.phone"
                                  label="Phone"
                                  prepend-inner-icon="mdi-phone">
                    </v-text-field>
                    <v-textarea v-model="form.address"
                                :error-messages="form.errors.address"
                                label="Address"
                                no-resize
                                prepend-inner-icon="mdi-map-marker"
                                rows="2">
                    </v-textarea>
                    <v-select v-show="roles"
                              v-model="form.roles"
                              :error-messages="form.errors.roles"
                              :items="roles"
                              chips
                              item-text="name"
                              item-value="id"
                              label="Roles"
                              multiple
                              prepend-inner-icon="mdi-shield-account">
                    </v-select>
                    <div class="d-flex">
                        <v-spacer></v-spacer>
                        <Link :href="route('users.index')"
                              as="v-btn"
                              color="secondary">Cancel
                        </Link>
                        <v-btn :disabled="form.processing"
                               class="ml-1"
                               color="primary"
                               type="submit">
                            submit
                        </v-btn>
                    </div>
                </v-form>
            </v-card-text>
        </v-card>
    </Admin>
</template>

<script>
import Admin from "@/Layouts/Admin";
import {Head, Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        Admin,
        Link,
        Head
    },
    props: {
        user: Object,
        roles: Array
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user ? this.user.name : '',
                email: this.user ? this.user.email : '',
                phone: this.user ? this.user.phone : '',
                address: this.user ? this.user.address : '',
                roles: ''
            })
        }
    },
    methods: {
        submit() {
            if (this.user)
                this.form.put(this.route('users.update', this.user));
            else
                this.form.post(this.route('users.store'));
        }
    }
}
</script>

<style scoped>

</style>