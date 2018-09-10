<template>
    <div class="md-layout md-gutter md-alignment-center">
        <div class="md-layout-item md-layout md-size-100">
            <md-chip class="md-accent mb-16 mt-16" md-clickable @click="changeSorting('name')">Name</md-chip>
            <md-chip class="md-accent mb-16 mt-16" md-clickable @click="changeSorting('cr_date')">Creation date</md-chip>
            <md-chip class="md-accent mb-16 mt-16" md-clickable @click="changeSorting('cl_date')">Closing date</md-chip>
        </div>
        <div class="md-layout-item md-layout md-size-100">
            <div v-for="capsule in capsules" :key="capsule.id" class="md-layout-item md-xlarge-size-20 md-large-size-25 md-medium-size-33 md-small-size-50 md-xsmall-size-100 mb-32">
                <md-card md-with-hover>
                    <md-card-header>
                        <div class="md-title">{{ capsule.title }}</div>
                    </md-card-header>

                    <md-card-content>
                        {{ capsule.description | truncate(200) }}
                    </md-card-content>

                    <md-card-actions md-alignment="space-between">
                        <div>
                            <md-button>
                                Edit
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
        <div class="md-layout-item md-layout md-size-100 md-alignment-center">
            <md-button class="md-primary md-raised md-layout-item md-size-5" @click="getNewCapsules" v-if="!moreLoading">
                More
            </md-button>
            <md-progress-spinner md-mode="indeterminate" v-else></md-progress-spinner>
        </div>
    </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex'
  export default {
    name: "Dashboard",
    mounted () {
    },
    created () {
      this.$store.dispatch('capsules/addCapsules', {
        amount: 8
      })
    },
    data () {
      return {
        moreLoading: false
      }
    },
    computed: mapState({
      capsules: state => state.capsules.all
    }),
    methods: {
      changeSorting (sort) {
        this.$store.dispatch('capsules/changeSort', {
          sort,
          amount: 8
        })
      },
      getNewCapsules () {
        this.$store.dispatch('capsules/addCapsules', {
          amount: 4
        })
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