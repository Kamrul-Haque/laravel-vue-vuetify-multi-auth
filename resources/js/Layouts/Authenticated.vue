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
                    <v-btn style="text-transform: none"
                           text
                           v-bind="attrs"
                           v-on="on">
                        {{ user.name }}
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
                          as="v-list-item"
                          method="post"
                          small
                          text>
                        <v-icon left
                                small>mdi-power
                        </v-icon>
                        <v-list-item-title>Logout</v-list-item-title>
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
                        <v-img v-if="user.avatar"
                               :src="user.avatar">
                        </v-img>
                        <v-icon v-else
                                large>mdi-account-circle
                        </v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{ user.name }}</v-list-item-title>
                        <v-list-item-subtitle>
                            {{ role }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item-group v-model="group"
                                   active-class="primary">
                    <Link :class="route().current('dashboard') ? 'primary' : ''"
                          :href="route('dashboard')"
                          as="v-list-item">
                        <v-list-item-icon>
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </Link>
                    <Link :class="route().current('users.*') ? 'primary' : ''"
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
            <v-container class="px-5 py-4"
                         fluid>
                <flash-message></flash-message>
                <slot/>
            </v-container>
        </v-main>
        <v-footer absolute
                  app
                  color="primary"
                  dark
                  padless>
            <v-col class="text-center"
                   cols="12">Copyright &copy; {{ $page.props.app.name }}
            </v-col>
        </v-footer>
    </v-app>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import FlashMessage from "@/Components/FlashMessage";

export default {
    components: {
        Link,
        FlashMessage
    },
    data() {
        return {
            group: null,
            drawer: true
        };
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
        role() {
            return this.$page.props.auth.user.roles[0].name;
        }
    },
};
</script>

<style>
html {
    overflow-y: auto
}
</style>
