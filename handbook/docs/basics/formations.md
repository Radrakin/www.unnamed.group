# Formations

::: warning THIS DOCUMENT IS INCOMPLETE
This document is still being worked on by our staff team
:::

## Wedge

<div id="formationWedge" class="formation"></div>

## Vee

<div id="formationVee" class="formation"></div>

## Column

<div id="formationColumn" class="formation"></div>

## Staggered Column

<div id="formationStaggeredColumn" class="formation"></div>

## Line

<div id="formationLine" class="formation"></div>

<!-- ## Baseline

<div id="formationBaseline" class="formation"></div> -->

## File

<div id="formationFile" class="formation"></div>

## Diamond

<div id="formationDiamond" class="formation"></div>

## Echelon

<div id="formationEchelon" class="formation"></div>

<script>
    if (typeof window !== 'undefined') {
        window.addEventListener('load', () => {
            createFormation("formationWedge", {
                width: 250,
                height: 150,
                formation: [
                    [0,0,1,0,0],
                    [0,1,0,1,0],
                    [1,0,0,0,1]
                ]
            });
            createFormation("formationVee", {
                width: 250,
                height: 150,
                formation: [
                    [1,0,0,0,1],
                    [0,1,0,1,0],
                    [0,0,1,0,0]
                ]
            });
            createFormation("formationColumn", {
                width: 250,
                height: 250,
                formation: [
                    [0,1,0,1,0],
                    [0,0,0,0,0],
                    [0,1,0,1,0],
                    [0,0,0,0,0],
                    [0,1,0,0,0]
                ]
            });
            createFormation("formationStaggeredColumn", {
                width: 250,
                height: 250,
                formation: [
                    [0,1,0,0,0],
                    [0,0,0,1,0],
                    [0,1,0,0,0],
                    [0,0,0,1,0],
                    [0,1,0,0,0]
                ]
            });
            createFormation("formationLine", {
                width: 250,
                height: 50,
                formation: [
                    [1,1,1,1,1]
                ]
            });
            createFormation("formationFile", {
                width: 50,
                height: 250,
                formation: [
                    [1],
                    [1],
                    [1],
                    [1],
                    [1]
                ]
            });
            createFormation("formationDiamond", {
                width: 250,
                height: 250,
                formation: [
                    [0,0,1,0,0],
                    [0,0,0,0,0],
                    [1,0,0,0,1],
                    [0,0,0,0,0],
                    [0,1,0,1,0]
                ]
            });
            createFormation("formationEchelon", {
                width: 250,
                height: 250,
                formation: [
                    [1,0,0,0,0],
                    [0,1,0,0,0],
                    [0,0,1,0,0],
                    [0,0,0,1,0],
                    [0,0,0,0,1]
                ]
            });
        });
    };
</script>
