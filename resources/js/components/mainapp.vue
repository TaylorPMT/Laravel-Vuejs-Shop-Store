<template>
    <div style="height: 100%;">
        <router-view />
        <Message></Message>
    </div>
</template>
<script>
import Message from "./modal/message";
export default {
    components: {
        Message
    }
};
</script>
