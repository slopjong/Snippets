JMS Serialization
=================

This experiment is made to become familiar with the JMS Serializer. It allows to annotate the models to be converted to XML. It also supports to unmarshal XML which means that you can convert a given XML back to an appropriate object.

Installation
------------

Run `./init.sh`.

Execution
---------

Run `./run.sh`. You should see the following output.


```
# Test 0: Serialization of a model (including two arrays)
######################################################################
<?xml version="1.0" encoding="UTF-8"?>
<Cps>
  <DefaultNic>DefaultNic</DefaultNic>
  <Description>Description</Description>
  <EmptyArray/>
  <Id>1</Id>
  <InterfaceList>
    <Interface>test1</Interface>
    <Interface>test2</Interface>
    <Interface>test3</Interface>
  </InterfaceList>
  <Ip>Ip</Ip>
  <Name>Name</Name>
</Cps>
----------------------------------------------------------------------
Model Object
(
    [name:protected] => Name
    [description:protected] => Description
    [id:protected] => 1
    [default_nic:protected] => DefaultNic
    [ip:protected] => Ip
    [interfaces:protected] => Array
        (
            [0] => test1
            [1] => test2
            [2] => test3
        )

    [empty_array:protected] => Array
        (
        )

)


######################################################################
# Test 1: Serialization/Deserialization roundtrip
######################################################################
<?xml version="1.0" encoding="UTF-8"?>
<TestList>
  <Test>test1</Test>
  <Test>test2</Test>
  <Test>test3</Test>
</TestList>
----------------------------------------------------------------------
<pre>Own handler callback for deserialization</pre>TestList Object
(
    [_elements:TestList:private] =>
    [_elements:Doctrine\Common\Collections\ArrayCollection:private] =>
)


######################################################################
# Test 2: Serialization/Deserialization roundtrip
######################################################################
<?xml version="1.0" encoding="UTF-8"?>
<TestList2>
  <Test>test1</Test>
  <Test>test2</Test>
  <Test>test3</Test>
</TestList2>
----------------------------------------------------------------------
TestList2 Object
(
    [_elements:TestList2:private] =>
    [list:TestList2:private] => Doctrine\Common\Collections\ArrayCollection Object
        (
            [_elements:Doctrine\Common\Collections\ArrayCollection:private] => Array
                (
                    [0] => test1
                    [1] => test2
                    [2] => test3
                )

        )

    [_elements:Doctrine\Common\Collections\ArrayCollection:private] =>
)


######################################################################
# Test 3: Serialization/Deserialization roundtrip
######################################################################
<?xml version="1.0" encoding="UTF-8"?>
<TestList3>
  <Test>test1</Test>
  <Test>test2</Test>
  <Test>test3</Test>
</TestList3>
----------------------------------------------------------------------
TestList3 Object
(
    [list:protected] => Doctrine\Common\Collections\ArrayCollection Object
        (
            [_elements:Doctrine\Common\Collections\ArrayCollection:private] => Array
                (
                    [0] => test1
                    [1] => test2
                    [2] => test3
                )

        )

    [_elements:CpsList:private] =>
    [_elements:Doctrine\Common\Collections\ArrayCollection:private] =>
)
----------------------------------------------------------------------
<?xml version="1.0" encoding="UTF-8"?>
<TestList3>
  <Test>test1</Test>
  <Test>test2</Test>
  <Test>test3</Test>
</TestList3>


######################################################################
# Test 4: Serialization/Deserialization roundtrip
######################################################################
<?xml version="1.0" encoding="UTF-8"?>
<TestList4/>
----------------------------------------------------------------------
TestList4 Object
(
    [_elements:TestList4:private] => Array
        (
        )

    [_elements:Doctrine\Common\Collections\ArrayCollection:private] =>
)
----------------------------------------------------------------------
<?xml version="1.0" encoding="UTF-8"?>
<TestList4/>
```

The outputs shows the result of the serialization/deserialization roundtrips of four different test cases.

In the first test case (#0) a model with some flat members and two arrays is serialized and correctly converted back again.

In the second and fifth test cases (#1, #4) the model is subclassing Doctrine's ArrayCollection and there's a data loss after the deserialization. Test case #1 is using a virtual property while in test case #4 the member `$_elements` of the ArrayCollection is overriden. However all the operations on `TestList4` are applied on `$_elements` of the superclass which is the cause for an incomplete initialized object after the deserialization.

In the test cases #2 and #3 the models are still subclassing the ArrayCollection but they keep both an additionally annotated ArrayCollection while all the manipulating operations are overriden to delegate the calls to the inner ArrayCollection object. By doing so the model definitions act like a proxy for the inner ArrayCollection which allows the XML serializer to properly do its job while the actual business logic can handle the models themselves as normal iterable ArrayCollections.

Conclusion
----------

Under certain conditions the serialized XML can always be converted back to an equivalent object as used for the serialization but for this the models must follow the pattern as implemented in `TestList2` or `TestList3`.

As of now it's recommended to migrate the CPS code to the new serializer as it will improve the code quality e.g. the members of all the models can become private/protected as they're not in the current development version (SVN commit r4550).

Note
----

Version 0.13.0 of the JMS Serializer is the last stable one but it has a bug which got reported [0] and which is automatically fixed by `init.sh`.

By default the JMS Serializer uses CDATA blocks to wrap text elements. However the output above shows you a clean XML which was achieved by recoding the XML by `SimpleXML`. Until now there's no possibility to configure the serializer accordingly. There are feature requests and patches already so that future versions might support optional CDATA blocks, see [1,2].

References
----------

[0] https://github.com/schmittjoh/serializer/issues/191#issuecomment-29574472
[1] https://github.com/schmittjoh/serializer/pull/119
[2] https://github.com/schmittjoh/serializer/pull/187