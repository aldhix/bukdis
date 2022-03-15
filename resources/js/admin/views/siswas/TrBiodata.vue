<template>
    <tr>
        <td style="width:40%">{{ label }}</td><td style="width:5%" class="text-right">:</td><td>{{ value || '-' }}</td>
    </tr>
</template>
<script>
export default {
    props:['label','value']
}
</script>
