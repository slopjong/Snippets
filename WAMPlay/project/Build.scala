import sbt._
import Keys._
import play.Project._

object ApplicationBuild extends Build {

  val appName         = "pubsub"
  val appVersion      = "1.0-SNAPSHOT"

  val appDependencies = Seq(
    javaCore,
    "ws.wamplay" %% "wamplay" % "0.2.6-SNAPSHOT" exclude("org.scala-stm", "scala-stm_2.10.0"),
    "com.typesafe.play" %% "play-slick" % "0.5.0.8" exclude("org.scala-stm", "scala-stm_2.10.0")
  )

  val main = play.Project(appName, appVersion, appDependencies).settings(
    resolvers ++= Seq("Bo's Repository" at "http://blopker.github.com/maven-repo/")
  )

}
