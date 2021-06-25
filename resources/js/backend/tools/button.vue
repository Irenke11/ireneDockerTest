<template>
<!-- <a class="dropdown-item" href="#">{{ name }}</a> -->
<!-- <a class="dropdown-item" :href="editGame(gameId)">{{ name }}</a> -->
    <button href="#" :class="classes" @click="click(data)" title="Update">
        <span>
            <i class="fa fa-eye" aria-hidden="true"></i>
        </span>
        &nbsp;
        {{ name }}
    </button>
</template>
<script>
export default {
    props: {
        data: {},
        name: {},
        // href:{
        //     editGame:function(val){
        //         return '{{editGame}}'+val
        //     }
        // },
        click: {
            type: Function,
            default: () => {}
        },
        classes: {
            type: Object,
            default: () => ({ 
                'btn': true,
                'btn-primary': true,
                'btn-sm': true,
            }),
        },
    }
}
</script>