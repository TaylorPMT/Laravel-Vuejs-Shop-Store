<template>
    <div class="image-preview" v-if="!isEmpty(dataCurrent.image)">
        <div class="item" v-for="(item,index) in dataCurrent.image" :key="'image-' + index">
            <img :src="asset(item)" :alt="'image-' + index" />
            <div class="delete-image" @click="deleteImage(index)">
                <span class="material-icons">clear</span>
            </div>
        </div>
    </div>
</template>
<script>
import mixin from "../../mix/mixin";

export default {
    mixins: [mixin],
    props: {
        dataCurrent: {

        }
    },
    methods: {
        async deleteImage(index) {
            let vm = this;
            vm.dataCurrent.image.splice(index, 1);
        }
    },
}
</script>
<style lang="scss" scoped>
.image-preview {
    margin-top: 30px;
    width: 100%;
    height: auto;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    .item {
        margin: 10px 5px;
        width: 150px;
        height: 150px;
        position: relative;
        > img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .delete-image {
            position: absolute;
            right: -10px;
            top: -10px;
            z-index: 9;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f44336;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s all;
            span {
                color: white;
                font-weight: bold;
                font-size: 20px;
            }
        }
        &:hover {
            .delete-image {
                opacity: 1;
                visibility: visible;
                transition: 0.3s all;
            }
        }
    }
}
</style>
