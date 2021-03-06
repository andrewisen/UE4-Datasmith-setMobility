# UE4 Datasmith - Set Mobility
[Python](https://www.python.org) script for [Unreal Engine 4 (UE4)](https://www.unrealengine.com/en-US/features) and [Datasmith](https://www.unrealengine.com/en-US/datasmith).</br>
The script changes the [mobility](https://docs.unrealengine.com/en-US/Engine/Actors/Mobility/index.html) of [Static Mesh Actors](https://docs.unrealengine.com/en-US/Engine/Actors/StaticMeshActor/index.html).</br>

Use the [Web Helper](https://github.andrewisen.se/UE4-Datasmith-setMobility/) to generate a Python file.</br>
Simply follow the instructions on the website and click "Download Python Script".

## Background
Given an [Autodesk Revit](https://www.autodesk.com/products/revit/overview) model.</br>
Assume one wants to create a game/application in UE4 where users can try interact with the world geometry.</br>
E.g. Try different room layouts by moving the furnitures around.

![Autodesk Revit 2020](docs/screenshots/screenshot-01.jpg?raw=true)

By using [Datasmith](https://www.unrealengine.com/en-US/datasmith), one could import said Revit file to UE4.

![Unreal Engine 4.24](docs/screenshots/screenshot-02.jpg?raw=true)

A problem occurs when working with the objects in the level.</br>

All imported Revit objects are stationary by defualt.</br>
Their movability should be set to **MOVABLE**.

![Mobility](docs/screenshots/screenshot-03.jpg?raw=true)

This scripts sets the mobility from **STATIC** to **MOVABLE** for all selected objects.</br>
In summary, one does not have to click on each individual object.

### Example
The [Collab Viewer Template](https://docs.unrealengine.com/en-US/Resources/Templates/CollabViewer/index.html) joins multiple people together in a shared experience of the same 3D content.</br>
It's intended to make it easier and quicker for your team to review and communicate about designs in realtime, so that you can identify problems and iterate on the content more efficiently.</br></br>

If you want to transform (i.e. move) certain objects, these objects should be set to **MOVABLE**.</br>
The Python Script might come in handy. 

## Getting Started
### Prerequisite
* [Unreal Datasmith Exporter for Autodesk Revit](https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/InstallingExporterPlugin/index.html)
* [Unreal Engine 4.24 or higher](https://www.unrealengine.com/en-US/get-now)

N.B. Datasmith should be included with 4.24. [Read more](https://docs.unrealengine.com/en-US/Support/Builds/ReleaseNotes/4_24/index.html)

Make sure the `Python Editor Script Plugin` and the `Datasmith Importer Plugin` are enabled.

![Plugins](docs/screenshots/screenshot-04.jpg?raw=true)

### Usage
1. [Export Datasmith Content from Revit](https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/SoftwareInteropGuides/Revit/ExportingDatasmithContentfromRevit/index.html)
2. [Import Datasmith Conent into EU4](https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/HowTo/ImportingContent/index.html)
3. [Enable Python in UE4](https://docs.unrealengine.com/en-US/Engine/Editor/ScriptingAndAutomation/Python/index.html)
4. Run the script in UE4 via `File->Execute Python Script`.

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

## Further Documentation
Further documentation can be found inside each folder.

* [Python Script](https://github.com/andrewisen/UE4-Datasmith-setMobility/tree/master/UE4_Script)
* [Web Helper](https://github.com/andrewisen/UE4-Datasmith-setMobility/tree/master/web_helper)

## Built with
* [Python 3.7.2](https://www.python.org/downloads/release/python-372/)
* [Unreal Python API](https://docs.unrealengine.com/en-US/PythonAPI/index.html)

## Contact
[kontakt "at" andrewisen.se](mailto:kontakt@andrewisen.se)

## Acknowledgments
*  [Aleksi Torhamo](https://stackoverflow.com/a/20228312) - Using `__import__` to dynamically import modules
*  [Ned Batchelder](https://nedbatchelder.com/blog/201206/eval_really_is_dangerous.html) - Security warnings regarding `Eval()`
* [Victor](https://stackoverflow.com/a/15758129) - Calling php function with AJAX and jQuery