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

            <li v-if="$page.props.auth.user">
                <NavLink
                    href="/requests"
                    :active="$page.component === 'Request/Index'"
                    >Your Requests</NavLink
                >
            </li>

            <li>
                <NavLink
                    href="/create"
                    :active="$page.component === 'Request/CreateRequest'"
                    >Create</NavLink
                >
            </li>

            <li v-if="$page.props.auth.user?.is_admin">
                <NavLink
                    href="/dashboard"
                    :active="
                        ['Admin/Users', 'Admin/Requests'].includes(
                            $page.component
                        )
                    "
                    >Dashboard</NavLink
                >
            </li>

            <li v-if="$page.props.auth.user">
                <NavLink href="/logout" method="post" as="button"
                    >Logout</NavLink
                >
            </li>

            <li v-if="!$page.props.auth.user">
                <NavLink
                    :active="$page.component === 'Auth/Register'"
                    href="/register"
                    >Signup</NavLink
                >
            </li>
        </ul>
    </nav>
</template>
