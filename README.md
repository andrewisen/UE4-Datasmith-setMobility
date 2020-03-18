# UE4 Datasmith - Set Mobility
Python script for Unreal Engine 4 (UE4) and Datasmith.</br>
The script changes the mobility of Static Mesh Actors.

## Background
Given an [Autodesk Revit](https://www.autodesk.com/products/revit/overview) model. 
Assume one wants to create a game/application where users can try different layouts.</br>
I.e. move the furnitures around and find the best placement. 

![Autodesk Revit 2020](docs/screenshots/screenshot-01.jpg?raw=true)

By using [Datasmith](https://www.unrealengine.com/en-US/datasmith), one could import said Revit file.

![Unreal Engine 4.24](docs/screenshots/screenshot-02.jpg?raw=true)

The problem occurs when working with the furnitures in the level.</br>
I.e. the imported Revit objects.</br>

These objects are stationary by defualt.</br>
There movability should be **MOVABLE**.

![Mobility](docs/screenshots/screenshot-03.jpg?raw=true)

This scripts sets the mobility to **MOVABLE** for all furnitures.</br>
In summary, one does not have to click on each individual object. 

## Getting Started
### Prerequisite
* [Unreal Engine 4.24 or higher](https://www.unrealengine.com/en-US/get-now)

N.B. Datasmith should be included with 4.24. [Read more](https://docs.unrealengine.com/en-US/Support/Builds/ReleaseNotes/4_24/index.html)

Make sure the `Python Editor Script Plugin` and the `Datasmith Importer Plugin` are enabled.

![Plugins](docs/screenshots/screenshot-04.jpg?raw=true)

### Usage
In addition, make sure you know how to use Python in UE4.</br>
See: [Scripting the Editor using Python](https://docs.unrealengine.com/en-US/Engine/Editor/ScriptingAndAutomation/Python/index.html)</br>
</br>
Then, simply run the script by using via `File->Execute Python Script` in UE4.

## Customize
### Mobility states
Set the mobily state by changing the variable:</br></br>
`mobility = mobilityStates[state]`</br></br>
where `state` is one of the following:
* 0 = STATIC
* 1 = STATIONARY
* 2 = MOVABLE

E.g. `mobility = mobilityStates[2]` sets the mobility to MOVABLE.

### Static Mesh Actors
Set which element categories should be affected:</br></br>
`metadataValues = ["Cat1", "Cat2", "Cat3"]`

E.g. `metadataValues = ["Furniture"]` will only affect objects that are categorized as *furnitures*.

## Built with
* [Python 3.7.2](https://www.python.org/downloads/release/python-372/)
* [Unreal Python API](https://docs.unrealengine.com/en-US/PythonAPI/index.html)

## Contact
[kontakt "at" andrewisen.se](mailto:kontakt@andrewisen.se)

## Acknowledgments
*  [Aleksi Torhamo](https://stackoverflow.com/a/20228312) - Using `__import__` to dynamically import modules
*  [Ned Batchelder](https://nedbatchelder.com/blog/201206/eval_really_is_dangerous.html) - Security warnings regarding `Eval()`