<template>
    <main>
        <section>
            <article v-for="capsule in capsules" :key="capsule.id">
                <h3>{{ capsule.title }}</h3>
                <p>{{ capsule.description }}</p>
                <p>{{ capsule.createdAt.date }}</p>
                <p>{{ capsule.closingAt.date }}</p>
            </article>
        </section>
        <button @click="getNewCapsules">More</button>
    </main>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    name: "Dashboard",
    created () {
      this.$store.dispatch('capsules/addCapsules', {
        amount: 8
      })
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

<style lang="scss" scoped>
    section {
        display: grid;
        grid-template-columns: repeat(auto-fill, 500px);
    }
</style>