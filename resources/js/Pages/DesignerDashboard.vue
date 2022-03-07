<template>
    <Authenticated>
        <Head title="Dashboard"/>
        <v-card>
            <v-card-title>Designer Dashboard</v-card-title>
        </v-card>
    </Authenticated>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue";
import Authenticated from "@/Layouts/Authenticated";

export default {
    components: {
        Head,
        Link,
        Authenticated
    },
};
</script>
