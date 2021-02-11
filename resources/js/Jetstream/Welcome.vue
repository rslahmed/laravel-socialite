<template>
    <div>
        <div class="px-6 py-12 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-2xl">
                Welcome to Laravel Socialite application!
            </div>

            <div class="flex mt-6">
                <div class="flex-shrink-0">
                    <div class="flex overflow-hidden">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white" :src="$page.props.user.profile_photo_path" alt="">
                    </div>
                </div>
                <div class="ml-4">
                    <dt class="text-lg leading-6 font-medium text-gray-900">
                        {{ $page.props.user.name }}
                    </dt>
                    <dd class="text-base text-gray-500">
                        {{ $page.props.user.email }}
                    </dd>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
