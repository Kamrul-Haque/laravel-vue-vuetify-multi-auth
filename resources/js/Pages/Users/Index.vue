<template>
    <Authenticated>
        <Head title="Users"/>
        <data-table :filters="filters"
                    :headers="headers"
                    :index-route="this.route('users.index')"
                    :items="users">
            <template v-slot:title>Users</template>

            <template v-slot:default="slotProp">
                <div v-if="slotProp.item.deleted_at === 'Active'">
                    <Link :href="route('users.assign.roles.form', slotProp.item)"
                          as="v-btn"
                          color="black"
                          icon
                          small
                          title="roles">
                        <v-icon small>mdi-account-circle</v-icon>
                    </Link>
                    <Link :href="route('users.edit', slotProp.item)"
                          as="v-btn"
                          color="accent"
                          icon
                          small
                          title="edit">
                        <v-icon small>mdi-pencil</v-icon>
                    </Link>
                    <Link :href="route('users.destroy', slotProp.item)"
                          as="v-btn"
                          color="warning"
                          icon
                          method="delete"
                          small
                          title="delete">
                        <v-icon small>mdi-delete</v-icon>
                    </Link>
                </div>

                <div v-else>
                    <Link :href="route('users.restore', slotProp.item)"
                          as="v-btn"
                          color="success"
                          icon
                          method="post"
                          small
                          title="restore">
                        <v-icon small>mdi-recycle</v-icon>
                    </Link>
                    <v-btn color="error"
                           icon
                           small
                           title="force-delete"
                           @click="deleteItem(slotProp.item)">
                        <v-icon small>
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </div>
            </template>

            <template v-slot:create-button>
                <Link :href="route('users.create')"
                      as="v-btn"
                      class="flex-column"
                      color="primary">
                    Create
                </Link>
            </template>
        </data-table>

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
    </Authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated";
import {Inertia} from "@inertiajs/inertia";
import {Head, Link} from "@inertiajs/inertia-vue";
import DataTable from "@/Components/DataTable";

export default {
    components: {
        Head,
        Authenticated,
        Link,
        DataTable
    },
    props: ['users', 'filters'],
    data() {
        return {
            headers: [
                {text: 'Name', value: 'name'},
                {text: 'Email', value: 'email'},
                {text: 'Phone', value: 'phone'},
                {text: 'Address', value: 'address'},
                {text: 'Status', value: 'deleted_at'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
            dialogDelete: false,
            itemId: '',
        }
    },
    methods: {
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