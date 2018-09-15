<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li><router-link to="/">Dashboard</router-link></li>
                    <li><router-link to="/account">Account</router-link></li>
                </ul>
            </nav>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>
  export default {
    name: 'App',
    data: () => ({

    })
  }
</script>

<style lang="scss" scoped>
</style>