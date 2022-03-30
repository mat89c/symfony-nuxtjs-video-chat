<template>
  <Chat />
</template>

<script lang="ts">
import Chat from '../../app/modules/chat/ui/Chat.vue'

export default {
  name: 'Home',
  middleware: 'auth',
  layout: 'default',
  components: {
    Chat
  }
}
</script>
