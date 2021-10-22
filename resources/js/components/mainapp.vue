<template>
    <div>
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
