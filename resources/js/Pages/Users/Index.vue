<template>
    <Authenticated>
        <div class="d-flex">
            <h5 class="text-h5 text--secondary text-uppercase font-weight-bold">Users</h5>
            <v-spacer></v-spacer>
            <v-select v-model="options.itemsPerPage"
                      :items="[1,5,10,15,20,25]"
                      class="col-4 col-md-1 text-caption mr-1"
                      dense
                      flat
                      hide-details
                      prefix="Per Page:"
                      solo>
            </v-select>
            <v-text-field v-model="search"
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
                      :items="users.data"
                      :options.sync="options"
                      :server-items-length="users.data.length"
                      class="elevation-1 my-2"
                      hide-default-footer>
            <template v-slot:item.actions="{ item }">
                <div v-if="item.deleted_at === 'Active'">
                    <Link :href="route('users.edit', item)"
                          as="v-btn"
                          color="accent"
                          icon
                          small>
                        <v-icon small>mdi-pencil</v-icon>
                    </Link>
                    <Link :href="route('users.destroy', item)"
                          as="v-btn"
                          color="warning"
                          icon
                          method="delete"
                          small>
                        <v-icon small>mdi-delete</v-icon>
                    </Link>
                </div>
                <div v-else>
                    <Link :href="route('users.restore', item)"
                          as="v-btn"
                          color="success"
                          icon
                          method="post"
                          small>
                        <v-icon small>mdi-recycle</v-icon>
                    </Link>
                    <v-btn color="error"
                           icon
                           small
                           @click="deleteItem(item)">
                        <v-icon small>
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </div>
            </template>
        </v-data-table>

        <v-dialog v-model="dialogDelete"
                  max-width="500px">
            <v-card>
                <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="accent"
                           text
                           @click="dialogDelete = !dialogDelete">Cancel
                    </v-btn>
                    <v-btn color="error"
                           text
                           @click="deleteItemConfirm">Confirm
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <div class="d-flex">
            <Paginator :links="users.links"></Paginator>

            <v-spacer></v-spacer>

            <Link :href="route('users.create')"
                  as="v-btn"
                  class="flex-column"
                  color="primary">
                Create
            </Link>
        </div>
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import {Inertia} from "@inertiajs/inertia";
import {Link} from "@inertiajs/inertia-vue";
import {debounce} from "lodash";
import Paginator from "@/Components/Paginator";
import DeleteConfirmation from "@/Components/DeleteConfirmation";

export default {
    components: {
        Authenticated,
        Paginator,
        Link,
        DeleteConfirmation
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
                {text: 'Status', value: 'deleted_at'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
            options: {},
            params: {},
            dialogDelete: false,
            itemId: '',
        }
    },
    watch: {
        options: {
            handler(value) {
                this.params.page = this.users.current_page;
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
        },
        deleteItem(item) {
            this.dialogDelete = true;
            this.itemId = item.id;
        },
        deleteItemConfirm() {
            this.dialogDelete = false;
            Inertia.delete(this.route('users.force.delete', this.itemId));
        }
    }
}
</script>

<style scoped>

</style>