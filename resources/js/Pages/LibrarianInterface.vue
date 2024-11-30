<script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import {
    UserIcon,
    MessageSquareIcon,
    CheckSquareIcon,
    LogOutIcon,
    LayoutDashboardIcon,
    PieChartIcon,
    CalendarIcon,
    SettingsIcon,
    EditIcon,
    TrashIcon,
    PlusIcon,
    EyeIcon,
} from "lucide-vue-next";

const user = ref({
    name: "Librarian1",
    email: "john@example.com",
    avatar: "/images/image.png",
    role: "Librarian", // Change this to "Librarian" for testing
});

const functionalities = ref([
    {
        id: "overview",
        name: "View",
        icon: EyeIcon, // View icon for Overview
        component: () => ({}),
    },
]);

// Add "Edit" and "Add" buttons for Librarians
if (user.value.role === "Librarian") {
    functionalities.value.push(
        {
            id: "edit",
            name: "Edit",
            icon: EditIcon,
            component: () => ({}),
        },
        {
            id: "insert",
            name: "Add",
            icon: PlusIcon,
            component: () => ({}),
        }
    );
}

const selectedFunctionality = ref("overview");

const selectFunctionality = (id) => {
    selectedFunctionality.value = id;
};

const currentFunctionalityComponent = computed(() => {
    const functionality = functionalities.value.find(
        (f) => f.id === selectedFunctionality.value
    );
    return functionality ? functionality.component : null;
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Library Management
            </h2>
        </template>

        <div class="flex h-screen bg-gray-100">
            <!-- Sidebar (1/4 width) -->
            <aside
                class="w-1/4 bg-gray-200 shadow-md p-6 flex flex-col h-full border-r border-black"
            >
                <div class="flex flex-col items-center mb-6">
                    <img
                        :src="user.avatar"
                        :alt="user.name"
                        class="w-24 h-24 rounded-full border-2 border-black mb-2"
                    />
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-800">
                            {{ user.name }}
                        </h2>
                        <p class="text-gray-600 text-lg">{{ user.email }}</p>
                        <p class="text-gray-500 text-lg">{{ user.role }}</p>
                    </div>
                </div>

                <div class="mt-auto">
                    <button
                        class="w-full px-4 py-2 bg-red-700 text-white rounded hover:bg-red-900 transition flex items-center justify-center"
                    >
                        <LogOutIcon class="w-5 h-5 mr-2" />
                        Logout
                    </button>
                </div>
            </aside>

            <!-- Main Content (3/4 width) -->
            <main class="w-3/4 p-8">
                <h1
                    class="text-3xl font-bold mb-6 text-gray-800 flex items-center"
                >
                    <LayoutDashboardIcon class="w-8 h-8 mr-2" />
                    Dashboard
                </h1>

                <!-- Functionality Buttons -->
                <div class="mb-6 flex space-x-4">
                    <button
                        v-for="func in functionalities"
                        :key="func.id"
                        @click="selectFunctionality(func.id)"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 transition flex items-center flex-1 justify-center"
                        :class="{
                            'bg-gray-700': selectedFunctionality === func.id,
                        }"
                    >
                        <component :is="func.icon" class="w-5 h-5 mr-2" />
                        {{ func.name }}
                    </button>
                </div>

                <!-- Dynamic Display Area -->
                <div
                    class="bg-gray-100 p-6 rounded-lg shadow-md border border-black h-64 overflow-y-auto"
                >
                    <component
                        :is="currentFunctionalityComponent"
                        v-if="currentFunctionalityComponent"
                    />
                    <p v-else class="text-gray-500">
                        Select a functionality to display content
                    </p>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
