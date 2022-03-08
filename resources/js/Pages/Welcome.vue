<template>
    <Front>
        <v-container>
            <v-card>
                <v-card-title>Welcome</v-card-title>
            </v-card>
        </v-container>
    </Front>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import Front from "@/Layouts/Front";

export default {
    components: {
        Front,
        Link,
    },
};
</script>
