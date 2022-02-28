<template>
    <Authenticated>
        <v-row class="mb-2">
            <v-col>
                <h5 class="text-h5 text--secondary text-uppercase font-weight-bold">Users</h5>
            </v-col>
            <v-col cols="3">
                <v-text-field v-model="search"
                              dense
                              flat
                              hide-details
                              label="Search"
                              prepend-inner-icon="mdi-magnify"
                              solo>
                </v-text-field>
            </v-col>
        </v-row>

        <v-data-table :headers="headers"
                      :items="users.data"
                      :options.sync="options"
                      :server-items-length="users.data.length"
                      class="elevation-1">
        </v-data-table>
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash";

export default {
    components: {
        Authenticated
    },
    props: ['users'],
    data() {
        return {
            search: '',
            headers: [
                {text: 'Name', value: 'name'},
                {text: 'Email', value: 'email'},
                {text: 'Phone', value: 'phone'},
                {text: 'Address', value: 'address'},
            ],
            options: {},
            params: {}
        }
    },
    watch: {
        options: {
            handler(value) {
                this.params.page = value.page;
                this.params.perPage = value.itemsPerPage;
                if (value.sortBy.length) {
                    this.params.sortBy = value.sortBy[0];
                    this.params.sortDesc = value.sortDesc[0] ? 'desc' : null;
                } else {
                    this.params.sortBy = null;
                    this.params.sortDesc = null;
                }
                this.updateData();
            },
            deep: true
        },
        search: debounce(function (value) {
            this.params.search = value;
            this.updateData();
        }, 300)
    },
    methods: {
        updateData() {
            Inertia.get(this.route('users.index'), this.params, {
                preserveScroll: true,
                preserveState: true,
                replace: true
            })
        }
    }
}
</script>

<style scoped>

</style>