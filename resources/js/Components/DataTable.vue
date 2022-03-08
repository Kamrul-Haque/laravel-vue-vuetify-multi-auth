<template>
    <div>
        <div class="d-flex">
            <h5 class="text-h5 secondary--text text-uppercase font-weight-bold">
                <slot name="title"></slot>
            </h5>
            <v-spacer></v-spacer>
            <v-select v-model="params.perPage"
                      :items="[5,10,15,20,25]"
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
                      :server-items-length="items.data.length"
                      :sort-by.sync="params.sortBy"
                      :sort-desc.sync="params.sortDesc"
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
    props: ["headers", "items", "filters", "indexRoute"],
    data() {
        return {
            params: {
                search: this.filters.search ? this.filters.search : "",
                sortBy: this.filters.sortBy ? this.filters.sortBy : null,
                sortDesc: !!this.filters.sortDesc,
                perPage: this.filters.perPage ? parseInt(this.filters.perPage) : 10,
            },
        };
    },
    watch: {
        params: {
            handler(value) {
                if (value.perPage !== parseInt(this.filters.perPage))
                    this.params.page = 1;
                else this.params.page = this.items.current_page;
                this.updateData();

                if (value.sortDesc)
                    this.params.sortDesc = 'desc';
                else
                    this.params.sortDesc = null;
            },
            deep: true,
        },
        search: debounce(function (value) {
            this.params.search = value;
            this.updateData();
        }, 300),
    },
    methods: {
        async updateData() {
            await Inertia.get(this.indexRoute, this.params, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },
    },
};
</script>
