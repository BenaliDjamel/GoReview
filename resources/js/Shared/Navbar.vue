<script setup>
import NavLink from "./NavLink";

</script>

<template>
    <nav>
        <ul class="flex space-x-6">
             <li>
                <NavLink href="/feed" :active="$page.component === 'Request/Feed'">Feed</NavLink>
            </li>

            <li>
                <NavLink href="/create" :active="$page.component === 'Request/CreateRequest'">Create</NavLink>
            </li>

            <li>
                <NavLink href="/requests" :active="$page.component === 'Request/Index'">My Requests</NavLink>
            </li>
            <li>
                <NavLink href="/dashboard" :active="$page.component === 'AdminPanel'">Admin</NavLink>
            </li>

            <li>
                <NavLink href="/logout" method="post" as="button">Logout</NavLink>
            </li>
        </ul>
    </nav>
</template>
