<template>
    <md-app md-mode="reveal">
        <md-app-toolbar class="md-primary">
            <div class="md-toolbar-row">
                <div class="md-toolbar-section-start">
                <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
                    <md-icon>menu</md-icon>
                </md-button>
                <span class="md-title">Capsule App</span>
                </div>
                <div class="md-toolbar-section-end">
                    <md-button class="md-icon-button" @click="handleLinkModal">
                        <md-icon>link</md-icon>
                    </md-button>

                    <md-button class="md-icon-button">
                        <md-icon>add</md-icon>
                    </md-button>
                </div>
            </div>
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
            <md-dialog-prompt
                    :md-active.sync="isInviteCapsuleModalActive"
                    v-model="inviteCapsuleModalText"
                    md-title="Join a capsule"
                    md-input-placeholder="Type your invite code"
                    md-confirm-text="Join"
                    @md-confirm="confirmInviteCapsuleModal"
                    @md-cancel="cleanLinkModalText"/>
            <router-view></router-view>

            <md-snackbar md-position="center" :md-duration="snackbarProperties.isInfinity ? Infinity : snackbarProperties.duration" :md-active.sync="snackbarProperties.isActive" md-persistent>
                <span>{{ snackbarProperties.message }}</span>
                <md-button class="md-primary" @click="handleSnackbar">Close</md-button>
            </md-snackbar>
        </md-app-content>
    </md-app>
</template>

<script>
  export default {
    name: 'App',
    data: () => ({
      menuVisible: false,
      inviteCapsuleModalText: '',
      isInviteCapsuleModalActive: false,
      snackbarProperties: {
        isActive: false,
        message: '',
        isInfinity: true,
        duration: 4000
      }
    }),
    methods: {
      hideDrawer () {
        this.menuVisible = false
      },
      handleLinkModal () {
        this.isInviteCapsuleModalActive = !this.isInviteCapsuleModalActive
      },
      handleSnackbar () {
        this.snackbarProperties.isActive = !this.snackbarProperties.isActive
      },
      cleanLinkModalText () {
        console.log('ok')
        this.inviteCapsuleModalText = ''
      },
      confirmInviteCapsuleModal () {
        this.$http.get(`/capsule/invite/${this.inviteCapsuleModalText}`)
          .then(response => {
            response.json()
              .then(data => {
                let capsule = data
                // if the status code is 200 but it's not a capsule that's mean you are already
                // contributors of the capsule
                if (capsule.id === undefined) {
                  this.snackbarProperties.message = capsule.message
                  this.snackbarProperties.isActive = true
                } else {
                  window.location = `/capsule/edit/${capsule.id}`
                }
              })
              .then(error => {
                console.log('error:json', error)
              })
          }, response => {
            console.log('error', response)
            this.snackbarProperties.message = 'No capsule matchs invite link.'
            this.snackbarProperties.isActive = true
          })
      }
    }
  }
</script>

<style lang="scss" scoped>
    .md-app {
        min-height: 100vh;
    }
</style>