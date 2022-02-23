<template>
    <Layout>
        <v-container>
            <v-card>
                <v-card-title>Welcome</v-card-title>
            </v-card>
        </v-container>
    </Layout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import Layout from "@/Layouts/Guest";

export default {
    components: {
        Link,
        Layout
    },
};
</script>
