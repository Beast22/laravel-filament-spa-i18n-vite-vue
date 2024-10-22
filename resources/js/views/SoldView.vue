<template>
    <div class="header-block-sold" id="sold">
        <h1>
            <span class="main-title">{{ $t('titles.sold_title') }}</span>
            <span class="main-title bold">
                {{ $t('titles.bora') }}
            </span>
        </h1>
    </div>
    <div class="block-sold">
        <div class="sold-inner"> Nothing to sold</div>      
    </div>
</template>

<style scoped>
.header-block-sold{
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-left: 20%;
    min-height: 30em;
    background: url('../../page-bg/sold-bg.jpg') no-repeat;
    background-size: cover;
}

.header-block-sold h1{
    display: flex;
    flex-direction: column;
    color: var(--scheme-color-bg);
    width: 11em;
    line-height: 1.5;
}
.header-block-buy h1{
    color: var(--scheme-color-bg);
    width: 11em;
    line-height: 1.5;
}

.block-sold {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 5em;
}

.sold-inner{
    padding: 7em 20%;
    border: 1px solid var(--scheme-color-primary);
}
</style>