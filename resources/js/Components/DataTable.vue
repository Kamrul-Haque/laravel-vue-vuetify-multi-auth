<template>
    <div>
        <div class="d-flex">
            <h5 class="text-h5 text--secondary text-uppercase font-weight-bold">
                <slot name="title"></slot>
            </h5>
            <v-spacer></v-spacer>
            <v-select v-model="params.perPage"
                      :items="[1,5,10,15,20,25]"
                      class="col-4 col-md-1 text-caption mr-1"
                      dense
                      flat
                      hide-details
                      prefix="Per Page:"
                      solo>
            </v-select>
            <v-text-field v-model="params.search"
                          class="col-5 col-md-3 col-lg-2"
                          dense
                          flat
                          hide-details
                          label="Search"
                          prepend-inner-icon="mdi-magnify"
                          solo>
            </v-text-field>
        </div>

        <v-data-table :headers="headers"
                      :items="items.data"
                      :options.sync="options"
                      :server-items-length="items.data.length"
                      class="elevation-1 my-2"
                      hide-default-footer>
            <template v-slot:item.actions="{ item }">
                <slot :item="item"></slot>
            </template>
        </v-data-table>

        <div class="d-flex">
            <Paginator :links="items.links"></Paginator>

            <v-spacer></v-spacer>

            <slot name="create-button"></slot>
        </div>
    </div>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash";
import Paginator from "@/Components/Paginator";

export default {
    components: {
        Authenticated,
        Paginator,
    },
    props: ['headers', 'items', 'filters', 'indexRoute'],
    data() {
        return {
            options: {},
            params: {
                search: (this.filters.search) ? this.filters.search : '',
                softBy: (this.filters.softBy) ? this.filters.softBy : '',
                sortDesc: (this.filters.sortDesc) ? this.filters.sortDesc : '',
                perPage: (this.filters.perPage) ? this.filters.perPage : 10,
            },
        }
    },
    watch: {
        options: {
            handler(value) {
                this.params.page = this.items.current_page;
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
        params: {
            handler(value) {
                if (value.perPage !== this.filters.perPage)
                    this.params.page = 1;
                else
                    this.params.page = this.items.current_page;
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
            Inertia.get(this.indexRoute, this.params, {
                preserveScroll: true,
                preserveState: true,
                replace: true
            })
        },
    }
}
</script>