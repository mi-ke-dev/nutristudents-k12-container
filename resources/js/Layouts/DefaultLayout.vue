<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <DefaultHeader />
            <div class="flex relative">
                <DefaultSidebar />
                <main class="w-full w-custom">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import DefaultHeader from '@/Pages/Partials/Header'
    import DefaultSidebar from '@/Pages/Partials/Sidebar'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,

            DefaultHeader,
            DefaultSidebar
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
<style>
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
@import 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap';
body{
    font-family: 'Lato', sans-serif !important;
}
.heading-color{
    color: #213665;
}

.searching-background-color {
    background-color :#38558e;
}

.button-color{
    background-color: #f7a53a;
}

@media (min-width: 1024px){
    .w-custom{
        width:calc(100% - 275px)
    }
}
</style>