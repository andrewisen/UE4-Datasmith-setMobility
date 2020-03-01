#!/usr/bin/python
import sys

def importUnreal():
	# Import the Unreal module
	# 	See: https://docs.unrealengine.com/en-US/Engine/Editor/ScriptingAndAutomation/Python/index.html
	# 
	# One could simply use "import unreal"
	# However, the "__import__" function is used to import the module globally
	# 	Credit: https://stackoverflow.com/a/20228312
	try:
		libary = __import__("unreal")
	except:
		print('NB. The file must be run in Unreal Engine using "Python Editor Script Plugin".')
		print(sys.exc_info())
		sys.exit()
	else:
		globals()["unreal"] = libary

def getStaticMeshActors():
	# Get all Static Mesh Actors in the current level.
	allActors = unreal.EditorLevelLibrary.get_all_level_actors()
	staticMeshActors = unreal.EditorFilterLibrary.by_class(allActors,unreal.StaticMeshActor)

	return staticMeshActors

def setMobility(staticMeshActors,mobility):
	# NB. The "Datasmith User Data" is located inside in the "Asset User Data" of the actor.
	# See: https://docs.unrealengine.com/en-US/Engine/Content/Importing/Datasmith/Overview/UsingDatasmithMetadata/index.html
	metadataKey = "Element_Category"
	metadataValues = ["Furniture"]

	for metadataValue in metadataValues:
		for actor in staticMeshActors:
			actorValue = unreal.DatasmithContentLibrary.get_datasmith_user_data_value_for_key(actor, metadataKey)
			if actorValue and metadataValue in actorValue:

				# NB. Eval is really dangerous!
				# See: https://nedbatchelder.com/blog/201206/eval_really_is_dangerous.html
				#
				# Another aproach would be to use:
				# 	globals()[class_name]

				print("Set mobility to " + mobility + " for: "+ actor.get_name())
				actor.set_mobility(eval("unreal.ComponentMobility." + mobility))

def main():
	# Tested with Python 3.7.2
	importUnreal()

	# Set Actor Mobility
	# Documentation: https://docs.unrealengine.com/en-US/Engine/Actors/Mobility/index.html
	# 
	# Mobility States:
	# 	0 = STATIC
	# 	1 = STATIONARY
	#	2 = MOVABLE
	mobilityStates = [ "STATIC", "STATIONARY","MOVABLE"]
	mobility = mobilityStates[2]

	# Set mobility for all Static Mesh Actors in the level
	setMobility(getStaticMeshActors(),mobility)

if __name__ == '__main__':
	main()