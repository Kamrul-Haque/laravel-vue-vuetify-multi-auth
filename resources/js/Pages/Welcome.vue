<template>
    <Guest>
        <v-container>
            <v-card>
                <v-card-title>Welcome</v-card-title>
            </v-card>
        </v-container>
    </Guest>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue";
import Guest from "@/Layouts/Guest";

export default {
    components: {
        Guest,
        Link,
    },
};
</script>
