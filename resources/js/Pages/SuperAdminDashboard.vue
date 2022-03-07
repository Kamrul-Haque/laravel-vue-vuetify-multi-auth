<template>
    <Authenticated>
        <Head title="Dashboard"/>
        <v-card>
            <v-card-title>Super Admin Dashboard</v-card-title>
        </v-card>
    </Authenticated>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue";
import Authenticated from "@/Layouts/Authenticated";

export default {
    components: {
        Authenticated,
        Link,
        Head
    },
};
</script>
