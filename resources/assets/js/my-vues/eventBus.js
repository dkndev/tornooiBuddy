import Vue from 'vue';
export const EventBus = new Vue();


// Listen for the i-got-clicked event and its payload.
// EventBus.$on('i-got-clicked', clickCount => {
//     console.log(`Oh, that's nice. It's gotten ${clickCount} clicks! :)`)
// });

EventBus.$on('TournamentPosts', tournaments => {
    console.log(`Oh, that's nice. It's gotten ${tournaments} clicks! :)`)
});