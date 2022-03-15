<template>
    <a :href="$url($config.admin_path+'/logout')"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="dropdown-item"><i class="fas fa-door-open mr-2"></i> Logout</a>
    <form :action="$url($config.admin_path+'/logout')" id="logout-form" method="post"></form>
</template>
