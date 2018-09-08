<template>
    <div class="md-layout md-gutter md-alignment-center">
        <div class="md-layout-item md-layout md-size-100">
            <md-chip class="md-accent mb-16 mt-16" md-clickable>Name</md-chip>
            <md-chip class="md-accent mb-16 mt-16" md-clickable>Date</md-chip>
            <md-chip class="md-accent mb-16 mt-16" md-clickable>Like</md-chip>
        </div>
        <div class="md-layout-item md-layout md-size-100">
            <div v-for="capsule in myCapsules" :key="capsule.id" class="md-layout-item md-xlarge-size-20 md-large-size-25 md-medium-size-33 md-small-size-50 md-xsmall-size-100 mb-32">
                <md-card md-with-hover>
                    <md-card-header>
                        <div class="md-title">{{ capsule.title }}</div>
                    </md-card-header>

                    <md-card-content>
                        {{ capsule.description | truncate(200) }}
                    </md-card-content>

                    <md-card-actions md-alignment="right">
                        <div>
                            <md-button class="md-icon-button">
                                <md-icon>favorite</md-icon>
                            </md-button>
                        </div>

                        <md-card-expand-trigger>
                            <md-button class="md-icon-button">
                                <md-icon>keyboard_arrow_down</md-icon>
                            </md-button>
                        </md-card-expand-trigger>
                    </md-card-actions>

                    <md-card-expand>
                        <md-card-expand-content>
                            <md-card-content>
                                <md-list class="md-double-line">
                                    <h3 class="md-subhead">Information</h3>
                                    <md-list-item>
                                        <md-icon class="md-primary">lock_open</md-icon>
                                        <div class="md-list-item-text">
                                            <span>{{ capsule.createdAt.date }}</span>
                                            <span>Creation date</span>
                                        </div>
                                    </md-list-item>
                                    <md-list-item>
                                        <md-icon class="md-primary">lock</md-icon>
                                        <div class="md-list-item-text">
                                            <span>{{ capsule.closingAt.date }}</span>
                                            <span>Closing date</span>
                                        </div>
                                    </md-list-item>
                                </md-list>
                            </md-card-content>
                        </md-card-expand-content>
                    </md-card-expand>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "Dashboard",
    mounted() {
      this.$http.get('/capsule')
        .then(response => {
            response.json()
              .then(data => {
                console.log(JSON.parse(data))
                this.myCapsules = JSON.parse(data)
              })
              .then(error => {
                console.log('error:json', error)
              })
        })
        .then(response => {
          console.log('error', response)
        })
    },
    data () {
      return {
        capsules: [
          {
            id: 1,
            title: 'My amazing time capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }, {
            id: 2,
            title: 'My great time capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }, {
            id: 3,
            title: 'Another great capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }, {
            id: 4,
            title: 'My amazing time capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }, {
            id: 5,
            title: 'My amazing time capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }, {
            id: 6,
            title: 'My amazing time capsule',
            description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
            createdAt: '2018-09-05 12:00:00',
            closingAt: '2018-10-05 12:00:00'
          }
        ],
        myCapsules: []
      }
    }
  }
</script>

<style scoped>
    .mb-32 {
        margin-bottom: 32px;
    }

    .mb-16 {
        margin-bottom: 16px;
    }

    .mt-16 {
        margin-top: 16px;
    }
</style>