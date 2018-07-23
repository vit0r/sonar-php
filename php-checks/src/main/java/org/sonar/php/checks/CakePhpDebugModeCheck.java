/*
 * SonarQube PHP Plugin
 * Copyright (C) 2010-2018 SonarSource SA
 * mailto:info AT sonarsource DOT com
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
package org.sonar.php.checks;

import com.google.common.collect.ImmutableSet;
import java.util.Set;
import org.sonar.check.Rule;
import org.sonar.php.checks.utils.CheckUtils;
import org.sonar.plugins.php.api.tree.Tree;
import org.sonar.plugins.php.api.tree.expression.ExpressionTree;
import org.sonar.plugins.php.api.tree.expression.FunctionCallTree;
import org.sonar.plugins.php.api.tree.expression.LiteralTree;
import org.sonar.plugins.php.api.visitors.PHPVisitorCheck;

import static org.sonar.php.checks.utils.CheckUtils.isTrueValue;
import static org.sonar.php.checks.utils.CheckUtils.trimQuotes;

@Rule(key = "S4507")
public class CakePhpDebugModeCheck extends PHPVisitorCheck {

  private static final String MESSAGE = "Make sure CakePHP's debug mode is not activated on production code.";

  private static final Set<String> CAKE_DEBUG_FUNCTIONS = ImmutableSet.of("Configure::write", "Configure::config");

  @Override
  public void visitFunctionCall(FunctionCallTree tree) {
    String functionName = CheckUtils.getFunctionName(tree);
    if (CAKE_DEBUG_FUNCTIONS.contains(functionName) && tree.arguments().size() == 2) {
      ExpressionTree firstArg = tree.arguments().get(0);
      ExpressionTree secondArg = tree.arguments().get(1);
      if (firstArg.is(Tree.Kind.REGULAR_STRING_LITERAL)
        && trimQuotes((LiteralTree) firstArg).equals("debug")
        && isTrueValue(secondArg)) {
        context().newIssue(this, tree, MESSAGE);
      }
    }
    super.visitFunctionCall(tree);
  }
}
