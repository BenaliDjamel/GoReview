<script setup>
import TabLink from "@/Components/Admin/TabLink.vue";
</script>

<template>
    <TabLink
        :href="route('admin.panel')"
        :active="$page.component === 'Admin/Users'"
    >
        Users
    </TabLink>
    <TabLink
        :href="route('admin.requests')"
        :active="$page.component === 'Admin/Requests'"
    >
        Requests
    </TabLink>
     <TabLink
        :href="route('admin.communities')"
        :active="$page.component === 'Admin/Communities'"
    >
        Communities
    </TabLink>
</template>
