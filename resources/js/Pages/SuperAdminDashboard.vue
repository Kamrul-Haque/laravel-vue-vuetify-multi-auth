<template>
    <Layout>
        <v-card>
            <v-card-title>Super Admin Dashboard</v-card-title>
        </v-card>
    </Layout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import Layout from "@/Layouts/Authenticated";

export default {
    components: {
        Link,
        Layout
    },
};
</script>
