<script setup>
import NavLink from "./NavLink";

</script>

<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/create" :active="$page.component === 'Request/CreateRequest'">Create</NavLink>
            </li>

            <li>
                <NavLink href="/requests" :active="$page.component === 'Request/Index'">My Requests</NavLink>
            </li>
            <li>
                <NavLink href="/dashboard" :active="$page.component === 'Dashboard'">Dashboard</NavLink>
            </li>

            <li>
                <NavLink href="/logout" method="post" as="button">Log Out</NavLink>
            </li>
        </ul>
    </nav>
</template>
