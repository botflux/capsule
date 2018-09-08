<template>
    <md-app md-mode="reveal">
        <md-app-toolbar class="md-primary">
            <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
                <md-icon>menu</md-icon>
            </md-button>
            <span class="md-title">Capsule App</span>
        </md-app-toolbar>

        <md-app-drawer :md-active.sync="menuVisible">
            <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

            <md-list>
                <md-list-item to="/" @click="hideDrawer">
                    <md-icon>home</md-icon>
                    <span class="md-list-item-text">Home</span>
                </md-list-item>

                <md-list-item to="/account" @click="hideDrawer">
                    <md-icon>settings</md-icon>
                    <span class="md-list-item-text">Account</span>
                </md-list-item>

                <md-list-item href="/logout">
                    <md-icon>exit_to_app</md-icon>
                    <span class="md-list-item-text">Logout</span>
                </md-list-item>
            </md-list>
        </md-app-drawer>

        <md-app-content>
            Hello world
            <router-view></router-view>
        </md-app-content>
    </md-app>
</template>

<script>
  export default {
    name: 'App',
    data: () => ({
      menuVisible: false
    }),
    methods: {
      hideDrawer () {
        this.menuVisible = false
      }
    }
  }
</script>

<style lang="scss" scoped>
    .md-app {
        min-height: 100vh;
    }
</style>