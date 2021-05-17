<template>
  <div class="notification-wrap position-relative">
    <button
      type="button"
      @click="toggleNotifications"
      class="text-white bg-transparent border-0"
    >
      <div v-if="notifications.length > 0">
        <i class="fas fa-bell fa-2x nofification-alert"></i>
      </div>
      <div v-else>
        <i class="fas fa-bell fa-2x "></i>
      </div>
    </button>
    <div :class="['notification', displayClass]">
      <ul v-if="notifications.length > 0" class="list-unstyled">
        <li
          class="border-bottom mb-3 pb-3"
          v-for="(notification, index) in notifications"
          :key="index"
        >
          <span
            class="remove  place-top"
            @click="removeCourse(index, notification.id)"
            ><i class="fas fa-times"></i>
          </span>
          <p>{{ notification.content }}</p>
          <a
            :href="notification.link.url"
            v-if="notification.link"
            class="btn btn-primary"
            >{{ notification.link.name }}</a
          >
          <!-- <span class="notify-time">01:00 PM</span> -->
        </li>
      </ul>
      <span v-else class="mb-3 pb-3">No Notification Found!!</span>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      notifications: [],
      displayClass: "d-none"
    };
  },
  methods: {
    toggleNotifications() {
      this.displayClass === "d-none"
        ? (this.displayClass = "d-block")
        : (this.displayClass = "d-none");
    },
    removeCourse(index, id) {
      axios.delete(route("notification.delete", id)).then(response => {
        console.log(
          response.data.status === "success"
            ? this.notifications.splice(index, 1)
            : ""
        );
      });
    }
  },

  created() {
    axios
      .get(route("notification.get"))
      .then(response => {
        response.data.status === "success"
          ? (this.notifications = response.data.notifications)
          : "";
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
