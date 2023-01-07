<template>
    <PanelItem :index="index" :field="field" class="nova-gutenberg">
        <template #value>
            <Excerpt :content="field.value" :should-show="field.shouldShow" />
        </template>
    </PanelItem>
</template>

<script>
export default {
    props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
    data: () => ({
        expanded: false
    }),
    methods: {
        toggle() {
            this.expanded = !this.expanded
        }
    },
    computed: {
        showHideLabel() {
            return this.expanded ? this.__('Hide Content') : this.__('Show Content')
        }
    }
}
</script>