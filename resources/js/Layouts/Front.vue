<template>
    <v-app>
        <v-app-bar app
                   color="white">
            <Link :href="route('welcome')"
                  as="v-btn"
                  text>
                <v-img contain
                       max-height="40px"
                       max-width="40px"
                       src="https://cdn.cdnlogo.com/logos/v/92/vue-js.svg">
                </v-img>
            </Link>
            <v-spacer></v-spacer>
            <Link v-if="user"
                  :href="route('dashboard')"
                  as="v-btn"
                  color="primary"
                  text>
                Dashboard
            </Link>
            <Link v-if="!user"
                  :href="route('login')"
                  as="v-btn"
                  color="primary"
                  text>
                Login
            </Link>
            <Link v-if="!user"
                  :href="route('register')"
                  as="v-btn"
                  color="secondary">
                Register
            </Link>
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main class="blue-grey lighten-5">
            <!-- Provides the application the proper gutter -->
            <v-container class="py-12">
                <flash-message></flash-message>
                <slot/>
            </v-container>
        </v-main>

        <v-footer app
                  outlined
                  padless>
            <v-col class="text-center"
                   cols="12">Copyright &copy; {{ $page.props.app.name }}
            </v-col>
        </v-footer>
    </v-app>
</template>

<style>
html {
    overflow-y: auto
}
</style>

<script>
import {Link} from "@inertiajs/inertia-vue";
import FlashMessage from "@/Components/FlashMessage";

export default {
    components: {
        Link,
        FlashMessage
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
    }
}
</script>
