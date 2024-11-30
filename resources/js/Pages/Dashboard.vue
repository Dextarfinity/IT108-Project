<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia"; // Correct import
import { ref } from "vue";

// Define props for the component
const props = defineProps({
  userName: String,
  userRole: Number, // To check if the user already has a role assigned
});

// Define a ref for the selected role and a flag to track role confirmation
const selectedRole = ref(props.userRole || null);
const roleConfirmed = ref(false);

// Function to handle the role selection and update the role
const updateRole = () => {
  if (selectedRole.value && selectedRole.value !== props.userRole) {
    // Send the new role to the server using Inertia
    Inertia.post("/dashboard/update-role", { role_id: selectedRole.value });
    roleConfirmed.value = true; // Mark role as confirmed
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            Hi <strong>{{ userName }}</strong
            >! You're logged in!
            <br />
            <span>Choose your role. (can only be set once)</span>

            <div>
              <label for="role" class="block mt-4 text-sm font-medium text-gray-700"
                >Select your role:</label
              >
              <select
                id="role"
                name="role"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                v-model="selectedRole"
                :disabled="roleConfirmed.value"
              >
                <option value="" disabled selected>Choose your role</option>
                <option value="2">User</option>
                <option value="3">Librarian</option>
              </select>
              <button
                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold text-xs uppercase tracking-widest hover:bg-blue-600 rounded-md"
                @click="updateRole"
                :disabled="roleConfirmed.value || selectedRole.value === null"
              >
                Confirm Role
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
