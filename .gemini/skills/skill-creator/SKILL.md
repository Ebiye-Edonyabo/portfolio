---
name: skill-creator
description: Creates new Agent Skills for Claude Code. Use when the user wants to create, develop, scaffold, or build a new Skill to teach Claude specialized capabilities.
---

# Skill Creator

Create custom Skills that teach Claude specialized capabilities for your projects.

## What is a Skill?

A Skill is a set of instructions that Claude follows when performing specific tasks. Skills are triggered automatically based on their description matching what the user asks for.

## Creating a New Skill

### Step 1: Create the Directory

```bash
mkdir -p .claude/skills/skill-name
```

Use lowercase names with hyphens (e.g., `api-builder`, `test-helper`, `deploy-manager`).

### Step 2: Create SKILL.md

Every skill requires a `SKILL.md` file with YAML frontmatter:

```yaml
---
name: skill-name
description: Brief description of what this Skill does and when to use it. Include trigger keywords users would naturally say.
---

# Skill Name

## Instructions

Clear, step-by-step guidance for Claude to follow...
```

### Step 3: Add Supporting Files (Optional)

For complex skills, add reference documentation:

```
.claude/skills/my-skill/
├── SKILL.md          # Required - main instructions
├── reference.md      # Optional - detailed docs
├── examples/         # Optional - example files
└── templates/        # Optional - code templates
```

## YAML Frontmatter Reference

### Required Fields

| Field | Description | Limit |
|-------|-------------|-------|
| `name` | Lowercase, hyphens only | 64 chars |
| `description` | What it does + when to use it | 1024 chars |

### Optional Fields

| Field | Description |
|-------|-------------|
| `allowed-tools` | Restrict which tools Claude can use |
| `model` | Specify a particular Claude model |

## Skill Storage Locations

| Location | Path | Scope |
|----------|------|-------|
| Personal | `~/.claude/skills/` | All your projects |
| Project | `.claude/skills/` | This repository only |

## Best Practices

1. **Write trigger-rich descriptions** - Include keywords users would naturally say
2. **Keep SKILL.md concise** - Under 500 lines, use separate files for details
3. **Be specific** - Clear instructions produce consistent results
4. **Include examples** - Show Claude what good output looks like
5. **Test after creating** - Restart Claude Code and try a matching request

## Example: Creating a "Component Builder" Skill

```bash
mkdir -p .claude/skills/component-builder
```

`.claude/skills/component-builder/SKILL.md`:

```yaml
---
name: component-builder
description: Creates Vue components with TypeScript and Tailwind CSS. Use when the user wants to build, create, or scaffold a new Vue component.
---

# Component Builder

## Instructions

When creating a Vue component:

1. Use Vue 3 Composition API with `<script setup lang="ts">`
2. Apply Tailwind CSS for styling
3. Include proper TypeScript types for props and emits
4. Follow project naming conventions

## Component Template

\`\`\`vue
<script setup lang="ts">
interface Props {
  // Define props here
}

const props = defineProps<Props>()
</script>

<template>
  <div>
    <!-- Component content -->
  </div>
</template>
\`\`\`
```

## Debugging Skills

If a skill doesn't trigger:

- Restart Claude Code after creating/modifying skills
- Check description includes specific trigger keywords
- Verify SKILL.md path is correct (case-sensitive)
- Validate YAML syntax (no tabs, proper indentation)
