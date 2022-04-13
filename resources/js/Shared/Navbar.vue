<script setup>
import NavLink from "./NavLink";
</script>

<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink
                    href="/feed"
                    :active="$page.component === 'Request/Feed'"
                    >Feed</NavLink
                >
            </li>

            <li>
                <NavLink
                    href="/create"
                    :active="$page.component === 'Request/CreateRequest'"
                    >Create</NavLink
                >
            </li>

            <li v-if="$page.props.auth.user">
                <NavLink
                    href="/requests"
                    :active="$page.component === 'Request/Index'"
                    >Your Requests</NavLink
                >
            </li>
            <li v-if="$page.props.auth.user">
                <NavLink
                    href="/dashboard"
                    :active="$page.component === 'AdminPanel'"
                    >Admin</NavLink
                >
            </li>

            <template v-if="$page.props.auth.user">
                <li>
                    <NavLink href="/logout" method="post" as="button"
                        >Logout</NavLink
                    >
                </li>
            </template>
            <template v-else>
                <li>
                    <NavLink href="/register">Signup</NavLink>
                </li>
            </template>
        </ul>
    </nav>
</template>
