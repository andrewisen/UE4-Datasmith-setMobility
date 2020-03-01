# UE4 Datasmith - Set Mobility
Python script for Unreal Engine 4 (UE4) and Datasmith.</br>
The script changes the mobility of Static Mesh Actors.

## Getting Started
### Prerequisite
* [Unreal Engine 4.24 or higher](https://www.unrealengine.com/en-US/get-now)
</br>
N.B. Datasmith should be included with 4.24 ([Read more](https://docs.unrealengine.com/en-US/Support/Builds/ReleaseNotes/4_24/index.html)).

### Usage
Make sure you know how to use Python in UE4.</br>
See: [Scripting the Editor using Python](https://docs.unrealengine.com/en-US/Engine/Editor/ScriptingAndAutomation/Python/index.html)
</br>
</br>
Then, simply run the script by using via `File->Execute Python Script` in UE4.

## Customize
### Mobility states
Set the mobily state by changing the variable:</br>
`mobility = mobilityStates[state]`</br>
where `state` is one of the following:
* 0 = STATIC
* 1 = STATIONARY
* 2 = MOVABLE

</br>
E.g. `mobility = mobilityStates[2]` sets the mobility to MOVABLE.

### Static Mesh Actors
Set which element categories should be affected.
`metadataValues = ["Cat1", "Cat2", "Cat3"]`

E.g. `metadataValues = ["Furniture"]` will only affect objects that are categorized as furnitures 

