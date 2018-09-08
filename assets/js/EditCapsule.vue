<template>
    <md-app md-waterfall md-mode="flexible">
        <md-app-toolbar class="md-large md-primary">
            <div class="md-toolbar-row">
                <div class="md-toolbar-section-start">
                    <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
                        <md-icon>menu</md-icon>
                    </md-button>
                </div>

                <div class="md-toolbar-section-end">
                    <md-button class="md-icon-button">
                        <md-icon>more_vert</md-icon>
                    </md-button>
                </div>
            </div>

            <div class="md-toolbar-row md-toolbar-offset">
                <span class="md-display-1">My Title</span>
            </div>
        </md-app-toolbar>

        <md-app-drawer :md-active.sync="menuVisible">
            <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

            <md-list>
                <md-list-item @click="showHelp()">
                    <md-icon>home</md-icon>
                    <span class="md-list-item-text">Home</span>
                </md-list-item>
                <md-list-item>
                    <md-icon>exit_to_app</md-icon>
                    <span class="md-list-item-text">Logout</span>
                </md-list-item>
            </md-list>
        </md-app-drawer>

        <md-app-content>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error quibusdam, non molestias et! Earum magnam, similique, quo recusandae placeat dicta asperiores modi sint ea repudiandae maxime? Quae non explicabo, neque.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error quibusdam, non molestias et! Earum magnam, similique, quo recusandae placeat dicta asperiores modi sint ea repudiandae maxime? Quae non explicabo, neque.</p>
        </md-app-content>
    </md-app>
</template>

<script>
  export default {
    name: 'edit-capsule',
    data: () => ({
      menuVisible: false
    }),
    methods: {
      showHelp () {
        console.log('help')
      }
    }
  }
</script>

<style lang="scss" scoped>


    .md-app {
        height: 100vh;
    }

    .md-app-toolbar {
        height: 196px;
    }
</style>