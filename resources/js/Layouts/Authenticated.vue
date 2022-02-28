<template>
    <v-app>
        <v-app-bar app
                   color="primary"
                   dark
                   flat>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>{{ ($page.props.app) ? $page.props.app.name : 'Laravel' }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
            <v-menu left
                    offset-y
                    transition="slide-y-transition">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn icon
                           v-bind="attrs"
                           v-on="on">
                        <v-icon>mdi-bell-outline</v-icon>
                    </v-btn>
                </template>

                <v-list dense>
                    <v-list-item
                            v-for="n in 5"
                            :key="n"
                            @click="() => {}">
                        <v-list-item-title>Option {{ n }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-menu offset-y
                    transition="slide-y-transition">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text
                           v-bind="attrs"
                           v-on="on">
                        Account
                    </v-btn>
                </template>

                <v-list dense>
                    <v-list-item @click="()=>{}">
                        <v-icon left
                                small>mdi-account
                        </v-icon>
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item>
                    <Link :href="route('logout')"
                          as="v-btn"
                          method="post"
                          small
                          text>
                        <v-icon left
                                small>mdi-power
                        </v-icon>
                        Logout
                    </Link>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer"
                             app
                             color="secondary"
                             dark>
            <v-list class="px-0"
                    dense
                    nav>
                <v-list-item>
                    <v-list-item-avatar left
                                        size="35">
                        <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{ $page.props.auth.user.name }}</v-list-item-title>
                        <v-list-item-subtitle>
                            {{ $page.props.auth.user.roles[0].name }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item-group v-model="group"
                                   active-class="primary">
                    <Link :class="route().current('admin.dashboard') ? 'primary' : ''"
                          :href="route('admin.dashboard')"
                          as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </Link>
                    <Link :class="route().current('users.index') ? 'primary' : ''"
                          :href="route('users.index')"
                          as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-account-group</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Users</v-list-item-title>
                    </Link>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <!-- Sizes your content based upon application components -->
        <v-main class="blue-grey lighten-5">

            <!-- Provides the application the proper gutter -->
            <v-container fluid>
                <slot/>
            </v-container>

            <v-footer absolute
                      color="primary"
                      dark
                      outlined
                      padless>
                <v-col class="text-center"
                       cols="12">Copyright &copy; {{ $page.props.app.name }}
                </v-col>
            </v-footer>
        </v-main>
    </v-app>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {
        Link
    },
    data() {
        return {
            group: null,
            drawer: true
        };
    },
    methods: {
        hasRole(role) {
            return this.$page.props.auth.user.roles.some(assigned => assigned.name === role);
        }
    }
};
</script>

<style>
html {
    overflow-y: auto
}
</style>
